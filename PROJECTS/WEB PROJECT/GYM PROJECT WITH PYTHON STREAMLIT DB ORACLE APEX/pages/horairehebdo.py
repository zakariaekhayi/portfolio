import streamlit as st
import requests
import json as js
from datetime import time
# Function to fetch data from the Oracle APEX API
def fetch_data(table_name):
    url = f'https://apex.oracle.com/pls/apex/wksp_123myworkspace123/{table_name}/?limit=10000'
    headers = {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
    }
    try:
        response = requests.get(url, headers=headers)
        response.raise_for_status()  # Raise an exception for HTTP error codes
        data = response.json()

        if response.status_code == 200:
            st.success(f'Data from the {table_name} table retrieved successfully.')
            return data.get('items', [])  # Return data from the 'items' key if it exists, otherwise an empty list
        else:
            st.warning(f'Request succeeded, but the status was {response.status_code}.')

    except requests.exceptions.RequestException as e:
        st.error(f'Error during HTTP request: {e}')

    return None

# Function to insert a new weekly session
def insert_weekly_session(code_e, id_s, jour, heure_debut, duree, gymsalle):
    horaire_data = fetch_data('horaire1')
    if horaire_data:
        existing_sessions = [item for item in horaire_data if item['jour'] == jour and item['heuredebut'] == heure_debut]
        if existing_sessions:
            return False, "Un cours existe déjà à cette heure."
    
    url = "https://apex.oracle.com/pls/apex/wksp_123myworkspace123/horaire1/"
    headers = {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
    }

    # Convert time object to string
    heure_debut_str = heure_debut.strftime('%H:%M:%S')

    data = {
        "codee": code_e,
        "jour": jour,
        "heuredebut": heure_debut_str,
        "duree": duree,
        "ids": id_s,
        "gymsalle": gymsalle
    }

    response = requests.post(url, headers=headers, json=data)

    if response.status_code == 201:
        return True, "Séance hebdomadaire insérée avec succès."
    else:
        return False, f"Échec de l'insertion. Code d'état: {response.status_code}"

# Streamlit UI for inserting new weekly session
def main():
    st.title("Insertion de nouvelles séances hebdomadaires")

    # Fetch data for dropdown menus
    coach_data = fetch_data('entraineur')
    session_data = fetch_data('seance1')

    if coach_data and session_data:
        coach_options = {item['codee']: f"{item['nom']} {item['prenom']}" for item in coach_data}
        session_options = {item['ids']: item['nom'] for item in session_data}

        # Form inputs
        code_e = st.selectbox("Sélectionnez l'entraîneur", options=list(coach_options.keys()), format_func=lambda x: coach_options[x])
        id_s = st.selectbox("Sélectionnez la séance", options=list(session_options.keys()), format_func=lambda x: session_options[x])
        gymsalle = st.text_input("Sélectionnez le Gym Salle")
        heure_debut = st.time_input("Heure de début")
        duree = st.slider("Duration (minutes):", min_value=15, max_value=60, step=15)

        # Select box for days of the week in French
        jours = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]
        jour = st.selectbox("Sélectionnez le jour", jours)

        # Button to submit the form
        if st.button("Insérer Séance Hebdomadaire"):
            success, message = insert_weekly_session(code_e, id_s, jour, heure_debut, duree, gymsalle)
            if success:
                st.success(message)
            else:
                st.error(message)

# Run the Streamlit app
if __name__ == "__main__":
    main()