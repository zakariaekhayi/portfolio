import requests
import streamlit as st
import pandas as pd
import plotly.express as px

# URL for schedule data
url_schedule = 'https://apex.oracle.com/pls/apex/wksp_123myworkspace123/horaire1/'

# URL for trainer data
url_trainer = 'https://apex.oracle.com/pls/apex/wksp_123myworkspace123/entraineur/'

headers = {
    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
}

# Fetch data from the URLs
response_schedule = requests.get(url_schedule, headers=headers)
response_trainer = requests.get(url_trainer, headers=headers)

# Check if the requests were successful
if response_schedule.status_code == 200 and response_trainer.status_code == 200:
    # Convert JSON data to DataFrames
    df_schedule_new = pd.DataFrame(response_schedule.json()["items"])
    df_trainer_new = pd.DataFrame(response_trainer.json()["items"])

    # Initialize DataFrames if not already defined
    if 'df_schedule' not in globals():
        df_schedule = pd.DataFrame(columns=['codee', 'jour', 'heuredebut', 'duree', 'ids', 'gymsalle'])
    if 'df_trainer' not in globals():
        df_trainer = pd.DataFrame(columns=['codee', 'nom', 'prenom'])

    # Append new data to existing DataFrames df_schedule and df_trainer
    df_schedule = pd.concat([df_schedule, df_schedule_new[['codee', 'jour', 'heuredebut', 'duree', 'ids', 'gymsalle']]], ignore_index=True)
    df_trainer = pd.concat([df_trainer, df_trainer_new[['codee', 'nom', 'prenom']]], ignore_index=True)

    # Sort the df_schedule DataFrame by 'jour' and 'heuredebut'
    df_schedule = df_schedule.sort_values(by=["jour", "heuredebut"])

    # Order of days of the week
    days_order = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]

    # Bar chart for the number of sessions per time slot
    fig_bar = px.bar(df_schedule, x="heuredebut", title="Number of sessions per time slot")

    # Line chart for the number of sessions per day of the week
    fig_line = px.line(
        df_schedule.groupby("jour").size().reset_index(name="session_count"),
        x="jour",
        y="session_count",
        title="Number of sessions per day of the week"
    )

    # Order the days of the week
    fig_line.update_xaxes(categoryorder='array', categoryarray=days_order)

    # Display the charts on the page
    st.title("Charts for Scheduled Sessions")

    # Bar chart
    st.plotly_chart(fig_bar)

    # Line chart
    st.plotly_chart(fig_line)

    st.success("Data updated successfully.")
else:
    st.error("Failed to fetch data from the URLs.")
