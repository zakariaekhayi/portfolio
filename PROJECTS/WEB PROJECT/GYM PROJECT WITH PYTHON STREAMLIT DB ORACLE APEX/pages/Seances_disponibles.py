import streamlit as st
import requests

# Function to fetch data from the API
def fetch_data(url):
    headers = {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3'
    }
    response = requests.get(url, headers=headers)
    if response.status_code == 200:
        return response.json()
    else:
        st.error(f"Error fetching data from {url}. Status code: {response.status_code}")
        return None

# Function to display and filter sessions
def display_and_filter_sessions(data):
    if "items" in data:
        st.subheader("Filter Sessions")

        # Display available session types
        session_types = list(set(session["type"] for session in data["items"]))
        selected_types = st.multiselect("Select session types", session_types)

        # Display level range slider
        level_range = st.slider("Select level range", min_value=1, max_value=5, value=(1, 5))

        # Filter sessions based on user input
        filtered_sessions = [session for session in data["items"] if
                             (not selected_types or session["type"] in selected_types) and
                             level_range[0] <= session["niveau"] <= level_range[1]]

        st.subheader("Session Information")
        st.write(f"Number of sessions: {len(filtered_sessions)}")

        # Display filtered sessions
        for session in filtered_sessions:
            st.write(f"Session: {session['nom']}, Type: {session['type']}, Niveau: {session['niveau']}")

        return filtered_sessions
    else:
        st.warning("No session data available.")
        return []

# Function to display schedules for selected sessions
def display_selected_schedules(data_horaire, selected_session_ids):
    st.subheader("Selected Schedules")

    # Filter schedules for selected session IDs
    selected_schedules = [schedule for schedule in data_horaire["items"] if schedule["ids"] in selected_session_ids]

    if selected_schedules:
        for schedule in selected_schedules:
            st.write(f"Jour: {schedule['jour']}, Heure de début: {schedule['heuredebut']}, Durée: {schedule['duree']} min, Salle: {schedule['gymsalle']}")
    else:
        st.warning("No schedules available for the selected sessions.")

# Main function
def main():
          


     


    st.title("Available Sessions Viewer")

    # Fetch data for sessions
    url_seance = "https://apex.oracle.com/pls/apex/wksp_123myworkspace123/seance1/"
    data_seance = fetch_data(url_seance)

    # Display and filter sessions
    filtered_sessions = display_and_filter_sessions(data_seance)

    # Fetch data for schedules
    url_horaire = "https://apex.oracle.com/pls/apex/wksp_123myworkspace123/horaire1/"
    data_horaire = fetch_data(url_horaire)

    # Display schedules for selected sessions
    selected_session_ids = st.multiselect("Select sessions to view schedules", [session["ids"] for session in filtered_sessions])
    display_selected_schedules(data_horaire, selected_session_ids)

# Run the app
if __name__ == "__main__":
    main()




