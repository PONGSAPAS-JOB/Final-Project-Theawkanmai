import sys
import pandas as pd
from sklearn.cluster import KMeans

# อ่านข้อมูลจากไฟล์ CSV
data = pd.read_csv('data.csv')

# รับค่า K จากผู้ใช้
k = int(sys.argv[1])

# ทำการจัดกลุ่ม
kmeans = KMeans(n_clusters=k)
data['Cluster'] = kmeans.fit_predict(data)

# พิมพ์ผลลัพธ์ออกมาในรูปแบบ CSV
output = data[['Cluster'] + data.columns.tolist()[:-1]]
output.to_csv(sys.stdout, index=False, header=False)
