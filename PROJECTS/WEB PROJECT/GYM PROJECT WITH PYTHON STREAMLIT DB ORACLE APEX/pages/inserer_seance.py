import streamlit as st
import requests

def fetch_trainers():
    url = 'https://apex.oracle.com/pls/apex/wksp_123myworkspace123/entraineur/'
    headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'}

    try:
        response = requests.get(url, headers=headers)
        response.raise_for_status()
        trainers_data = response.json()
        return trainers_data['items']

    except requests.exceptions.RequestException as e:
        st.error(f'Erreur lors de la requête HTTP pour récupérer les entraineurs : {e}')

def fetch_sessions():
    url = 'https://apex.oracle.com/pls/apex/wksp_123myworkspace123/seance1/'
    headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'}

    try:
        response = requests.get(url, headers=headers)
        response.raise_for_status()
        sessions_data = response.json()
        return sessions_data['items']

    except requests.exceptions.RequestException as e:
        st.error(f'Erreur lors de la requête HTTP pour récupérer les séances : {e}')

def fetch_session_schedule():
    url = 'https://apex.oracle.com/pls/apex/wksp_123myworkspace123/horaire1/'
    headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'}

    try:
        response = requests.get(url, headers=headers)
        response.raise_for_status()
        schedule_data = response.json()
        return schedule_data['items']

    except requests.exceptions.RequestException as e:
        st.error(f'Erreur lors de la requête HTTP pour récupérer les horaires : {e}')

def check_existing_ids(ids, existing_ids):
    return ids in existing_ids

def insert_session(data):
    url = 'https://apex.oracle.com/pls/apex/wksp_123myworkspace123/seance1/'
    headers = {'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3',
               'Content-Type': 'application/json'}

    try:
        response = requests.post(url, json=data, headers=headers)
        response.raise_for_status()
        st.success('Insertion réussie!')
    except requests.exceptions.RequestException as e:
        st.error(f'Erreur lors de la requête HTTP pour insérer la séance : {e}')

def main():
    st.title("Formulaire d'insertion de séance hebdomadaire")

    trainers = fetch_trainers()
    sessions = fetch_sessions()
    schedule = fetch_session_schedule()

    existing_ids = [session['ids'] for session in sessions]

    # Form inputs
    ids = st.text_input("Identite de la séance (ids)")
    nom = st.text_input("Nom de la séance")
    type_seance = st.selectbox("Type de séance", ["Group", "Individual"])
    niveau = st.number_input("Niveau (entre 1 et 4)", min_value=1, max_value=4)
   

    if st.button("Insérer la séance"):
        # Data to be inserted
        data = {
            "ids": ids,
            "nom": nom,
            "type": type_seance,
            "niveau": niveau,
           
        }

        # Perform validation and insertion
        if not all(data.values()):
            st.error("Tous les champs doivent avoir une valeur.")
        elif niveau not in [1, 2, 3, 4]:
            st.error("Le niveau doit être un entier entre 1 et 4.")
        elif check_existing_ids(ids, existing_ids):
            st.error("L'identité de la séance (ids) existe déjà. Choisissez une autre identité.")
        else:
            insert_session(data)

if __name__ == "__main__":
    main()
