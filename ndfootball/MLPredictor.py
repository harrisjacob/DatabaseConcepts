#! /usr/bin/python3

import sys
import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.preprocessing import LabelEncoder
import sklearn
import mysql.connector

cnx = mysql.connector.connect(user='mcoffey1', password='mcoffey1',
                              host='localhost',
                              database='mcoffey1')
cursor = cnx.cursor()

query = ("SELECT Situation, pff_DRIVESTARTEVENT, Series, Quarter, pff_CLOCK, pff_SCORE, Down, Dist, FieldPos, Hash, Personnel, Formation, MOFO_Safeties, Coverage FROM ")
table = sys.argv[2]

query = query + table;
cursor.execute(query)
table_rows = cursor.fetchall()
df = pd.DataFrame(table_rows);
#df = pd.read_csv("UGA.csv_final.csv")
ALL = ["Situation",	"pff_DRIVESTARTEVENT",	"Series",	"Quarter",	"pff_CLOCK",	"pff_SCORE",	"Down",	"Dist",	"FieldPos",	"Hash",	"Personnel",	"Formation", "MOFO_Safeties", "Coverage"]
df.columns = ALL
ATTR = ["Situation",	"pff_DRIVESTARTEVENT",	"Series",	"Quarter",	"pff_CLOCK",	"pff_SCORE",	"Down",	"Dist",	"FieldPos",	"Hash",	"Personnel",	"Formation", "MOFO_Safeties"]
#print(list(df.columns.values))
df = df.dropna(subset=["Coverage"])
df = df[ALL].copy()
values = {"Situation": -1, "pff_DRIVESTARTEVENT": "", "Series": -1, "Quarter": -1, "pff_CLOCK": "", "pff_SCORE" : 0.0, "Down": -1, "Dist" : -1, "Hash": "", "Personnel": -1, "Formation": "", "MOFO_Safeties" : "C"}
df.fillna(value=values, inplace=True)
features = sys.argv[1].split(",")

features[0] = int(features[0])
features[2] = int(features[2])
features[3] = int(features[3])
features[5] = float(features[5])
features[6] = int(features[6])
features[7] = int(features[7])
features[8] = int(features[8])
features[10] = int(features[10])
df = df.append(pd.Series(features, index=df.columns), ignore_index=True)
le = sklearn.preprocessing.LabelEncoder()
df = df.apply(le.fit_transform)

row = df.tail(1)[ATTR]
df.drop(df.tail(1).index,inplace=True)

#df_train, df_test = train_test_split(df, test_size=0.30)
clf = RandomForestClassifier(max_depth=8, n_estimators = 100, min_samples_split=16)
clf = clf.fit(df[ATTR], df['Coverage'])
prediction = clf.predict_proba(row)
mapping = dict(zip(le.classes_, range(len(le.classes_))))
rev_mapping = dict(zip(range(len(le.classes_)), le.classes_))
prediction = prediction[0]
pred_covs = sorted(range(len(prediction)), key=lambda i: prediction[i])[-5:]
print("<table> <tr> <th> {} </th> <th> {} </th></tr>\n".format("Coverage", "Likelihood"))
for cov in reversed(pred_covs):
	print("<tr><td>{:^100}</td> <td>{:1.2f}%</td></tr>\n".format(rev_mapping[cov], float(prediction[cov]*100)))
print("</table></br>")
