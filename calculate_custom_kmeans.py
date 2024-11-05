import sys
import pandas as pd
import json
from sklearn.cluster import KMeans
from sklearn.preprocessing import StandardScaler

def calculate_percentage(df, column, total_counts):
    return df[column].value_counts(normalize=True).reindex(range(1, total_counts + 1), fill_value=0) * 100

# Read data from CSV
data = pd.read_csv('data.csv')

# Columns used for clustering
selected_columns = [
    'eva_p1_ans1', 'eva_p1_ans2', 'eva_p1_ans3', 'eva_p1_ans4', 
    'eva_p1_ans5', 'eva_p1_ans6', 'eva_p1_ans7', 'eva_p1_ans8', 
    'eva_p1_ans9', 'eva_p2_ans1', 'eva_p2_ans2', 'eva_p2_ans3',
    'eva_p2_ans4', 'eva_p2_ans5', 'eva_p2_ans6', 'eva_p2_ans7',
    'eva_p2_ans8', 'eva_p2_ans9', 'eva_p2_ans10', 'eva_p2_ans11', 
    'eva_p2_ans12', 'eva_p2_ans13', 'eva_p2_ans14', 'eva_p2_ans15', 
    'eva_p2_ans16', 'eva_p2_ans17', 'eva_p2_ans18', 'eva_p2_ans19'
]

# Convert to numeric and fill NaNs with 0
datacluster = data[selected_columns].apply(pd.to_numeric, errors='coerce').fillna(0)

# Get K value from command line arguments
k = int(sys.argv[1])

# Scale the data
scaler = StandardScaler()
ratings_scaled = scaler.fit_transform(datacluster)

# Perform K-means clustering
kmeans = KMeans(n_clusters=k, init='k-means++', max_iter=300, n_init=10, random_state=42)
clusters = kmeans.fit_predict(ratings_scaled) + 1  # Add 1 to cluster numbers

# Add Cluster column to the original data
data['Cluster'] = clusters

# Calculate mean values for each cluster
cluster_summary = data.groupby('Cluster').mean()[selected_columns]

# Count the number of instances in each cluster
cluster_counts = data['Cluster'].value_counts().sort_index()

# Calculate percentages for each answer option in each cluster
interest_columns = [
    'ans1', 'ans2', 'ans3', 'ans4', 'ans5', 'ans6', 'ans7', 'ans8',
    'ans_form1', 'ans_form2', 'ans_form3', 'ans_form4', 'ans_form5', 'ans_form6', 'ans_form7', 'ans_form8'
]

cluster_interest_percentages = {}
for cluster in range(1, k + 1):  # Adjusted to match the new cluster numbering
    cluster_data = data[data['Cluster'] == cluster]
    cluster_interest_percentages[cluster] = {
        column: calculate_percentage(cluster_data, column, cluster_data[column].nunique()).tolist()
        for column in interest_columns
    }

# Format results as JSON
results = {
    cluster: {
        'count': int(cluster_counts[cluster]),
        'interest_percentages': cluster_interest_percentages[cluster],
        'average_values': cluster_summary.loc[cluster].to_dict()
    }
    for cluster in range(1, k + 1)  # Adjusted to match the new cluster numbering
}

# Print JSON result
print(json.dumps(results))
