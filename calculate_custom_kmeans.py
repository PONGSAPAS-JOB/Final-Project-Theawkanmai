import sys
import pandas as pd
from sklearn.cluster import KMeans
from sklearn.preprocessing import StandardScaler

# อ่านข้อมูลจากไฟล์ CSV
data = pd.read_csv('data.csv')

# เลือกเฉพาะคอลัมน์ที่ต้องการ
selected_columns = [
    'eva_p1_ans1', 'eva_p1_ans2', 'eva_p1_ans3', 'eva_p1_ans4', 
    'eva_p1_ans5', 'eva_p1_ans6', 'eva_p1_ans7', 'eva_p1_ans8', 
    'eva_p1_ans9', 'eva_p2_ans1', 'eva_p2_ans10', 'eva_p2_ans11', 
    'eva_p2_ans12', 'eva_p2_ans13', 'eva_p2_ans14', 'eva_p2_ans15', 
    'eva_p2_ans16', 'eva_p2_ans17', 'eva_p2_ans18', 'eva_p2_ans19'
]

# สร้าง DataFrame สำหรับการจัดกลุ่ม
datacluster = data[selected_columns].apply(pd.to_numeric, errors='coerce').fillna(0)

# รับค่า K จาก command line argument
k = int(sys.argv[1])

scaler = StandardScaler()
ratings_scaled = scaler.fit_transform(datacluster)

# ทำการคำนวณ K-means clustering
kmeans = KMeans(n_clusters=k, init='k-means++', max_iter=300, n_init=10, random_state=42)
clusters = kmeans.fit_predict(ratings_scaled)

# เพิ่มคอลัมน์ 'Cluster' ใน DataFrame ต้นฉบับ
data['Cluster'] = clusters

# คำนวณค่าเฉลี่ยของแต่ละฟีเจอร์ในแต่ละคลัสเตอร์
cluster_summary = data.groupby('Cluster').mean()

# นับจำนวนคนในแต่ละคลัสเตอร์
cluster_counts = data['Cluster'].value_counts().sort_index()

# นับจำนวนคนที่ตอบ 1 ในแต่ละคอลัมน์ ans1 ถึง ans8 ในแต่ละคลัสเตอร์
ans_interest_counts = data.groupby('Cluster')[['ans1', 'ans2', 'ans3', 'ans4', 'ans5', 'ans6', 'ans7', 'ans8']].apply(lambda x: (x == 1).sum())

# เปลี่ยนจากจำนวนคนเป็นเปอร์เซ็นต์
ans_interest_percentages = (ans_interest_counts.div(cluster_counts, axis=0) * 100).round(2)

# แปลงสรุปคลัสเตอร์เป็นรูปแบบ JSON ที่ต้องการ
clusters = {}
for cluster_id in range(k):
    cluster_means = cluster_summary.loc[cluster_id].tolist()
    interest_percentages = ans_interest_percentages.loc[cluster_id].tolist()
    clusters[cluster_id + 1] = {
        'means': cluster_means,
        'interest_counts': interest_percentages,  # ใช้เปอร์เซ็นต์แทนจำนวน
        'count': int(cluster_counts[cluster_id])
    }

# พิมพ์ผลลัพธ์การจัดกลุ่มในรูปแบบ JSON
import json
print(json.dumps(clusters))

