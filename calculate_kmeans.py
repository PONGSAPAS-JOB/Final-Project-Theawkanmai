import numpy as np
import pandas as pd
from sklearn.cluster import KMeans
import matplotlib.pyplot as plt

# อ่านข้อมูลจากไฟล์ CSV
data = pd.read_csv('data.csv')

# Elbow method to find the optimal k
sse = []
k_range = range(1, 11)
for k in k_range:
    kmeans = KMeans(n_clusters=k)
    kmeans.fit(data)
    sse.append(kmeans.inertia_)

# Plotting the Elbow Method graph
plt.figure(figsize=(10, 6))
plt.plot(k_range, sse, marker='o')
plt.title('Elbow Method for Optimal K')
plt.xlabel('Number of clusters')
plt.ylabel('SSE')
plt.savefig('elbow_method.png')

# Finding the optimal K values (where the largest drops occur)
sse_diff = np.diff(sse)
second_diff = np.diff(sse_diff)
elbow_points = np.argsort(second_diff)[-2:] + 2  # Indices of the largest two second differences

optimal_k = sorted(elbow_points)

# Print the optimal K values
print(" ".join(map(str, optimal_k)))
