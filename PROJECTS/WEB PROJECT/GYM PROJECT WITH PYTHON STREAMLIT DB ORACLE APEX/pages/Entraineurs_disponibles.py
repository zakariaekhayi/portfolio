import streamlit as st
import pandas as pd
import requests
from datetime import datetime

# Function to fetch data from the API
def fetch_data(url):
    headers = {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
    }
    try:
        response = requests.get(url, headers=headers)
        response.raise_for_status()
        data = response.json()
        return data['items']
    except requests.exceptions.RequestException as e:
        st.error(f'Erreur lors de la requête HTTP : {e}')
        return []

# Function to filter trainers based on last name and date of birth range
def filter_trainers(data, last_name_filter, date_range_filter):
    if not data:
        return []

    filtered_trainers = []
    for trainer_details in data:
        last_name_match = last_name_filter.lower() in trainer_details['nom'].lower()
        
        if 'datenaissance' in trainer_details:
            birth_date = datetime.strptime(trainer_details['datenaissance'], "%Y-%m-%d").date()
            date_range_match = date_range_filter[0] <= birth_date <= date_range_filter[1]
        else:
            date_range_match = False

        if last_name_match and date_range_match:
            filtered_trainers.append(trainer_details)

    return filtered_trainers

# Fetch data from the API
api_data = fetch_data('https://apex.oracle.com/pls/apex/wksp_123myworkspace123/entraineur/')

# Check if data is fetched successfully
if not api_data:
    st.warning("Aucune donnée n'a pu être récupérée depuis l'API.")
else:
    # Create a DataFrame from API data
    api_df = pd.DataFrame(api_data)

    # Interface utilisateur Streamlit
    st.title("Entraîneurs Disponibles")

    # Filter options
    last_name_filter = st.text_input("Filtrer par nom de famille:")
    date_range_filter = st.date_input("Filtrer par plage de dates:", [datetime(1900, 1, 1), datetime.today()])

    # Filter trainers
    filtered_trainers = filter_trainers(api_data, last_name_filter, date_range_filter)

    # Display filtered trainer details
    if not filtered_trainers:
        st.warning("Aucun entraîneur trouvé avec les filtres spécifiés.")
    else:
        st.subheader("Entraîneurs filtrés:")
        for trainer_details in filtered_trainers:
            st.write(f"Nom: {trainer_details['nom']}")
            st.write(f"Prénom: {trainer_details['prenom']}")
            st.write(f"Date de naissance: {trainer_details.get('datenaissance', 'N/A')}")
            st.write(f"Email: {trainer_details.get('email', 'N/A')}")
            st.write(f"Numéro de téléphone: {trainer_details.get('numerotelephone', 'N/A')}")
            st.write(f"Liens: {trainer_details['links'][0]['href']}")
            st.write("---")  # Add a separator between trainer details
