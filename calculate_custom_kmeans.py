import sys
import pandas as pd
from sklearn.cluster import KMeans
from sklearn.preprocessing import StandardScaler
# อ่านข้อมูลจากไฟล์ CSV
data = pd.read_csv('data.csv')

datacluster = data.apply(pd.to_numeric, errors='coerce').fillna(0)
# รับค่า K จาก command line argument
k = int(sys.argv[1])

scaler = StandardScaler()
ratings_scaled = scaler.fit_transform(datacluster)
# ทำการคำนวณ K-means clustering
kmeans = KMeans(n_clusters=k, init='k-means++', max_iter=300, n_init=10, random_state=42)
clusters = kmeans.fit_predict(ratings_scaled)

# Add the 'Cluster' column to the original DataFrame
data['Cluster'] = clusters

# Calculate the mean of each feature in each cluster
cluster_summary = data.groupby('Cluster').mean()

# Convert cluster summary to the desired JSON format
clusters = {}
for i in range(k):
    cluster_means = cluster_summary.loc[i].tolist()
    clusters[i + 1] = cluster_means

# พิมพ์ผลลัพธ์การจัดกลุ่มในรูปแบบ JSON
import json
print(json.dumps(clusters))
