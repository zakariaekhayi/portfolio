import streamlit as st

# Function for the personalized home page with more details
def home_page():
    st.title("Bienvenue à FitnessXperience! 🏋️‍♂️")
    st.image("photo/OIG.Em9tYB.jpeg", width=800)
    
    st.write("Bienvenue chez FitnessXperience, votre partenaire ultime pour une vie saine et équilibrée ! 🌟 Notre salle de sport n'est pas seulement un lieu d'entraînement, c'est un véritable sanctuaire dédié à votre bien-être physique et mental.")
    
    st.write("Situé au cœur de notre communauté, FitnessXperience rassemble des individus déterminés à adopter un mode de vie actif. Nos coachs certifiés et nos services exclusifs font de nous bien plus qu'une salle de sport – nous sommes une famille engagée dans votre transformation ! 💪")

    st.image("photo/o.jpeg", width=800)
    
    st.write("Rejoignez-nous dans cet espace où chaque goutte de sueur est une victoire, et chaque pas vers la forme physique est une célébration. Chaque battement de cœur vous rapproche de votre meilleure version, et la passion pour le bien-être devient une expérience partagée.")
    
    st.image("photo/photo.jpg", width=800)
    
    st.write("Embarquez pour une vie plus saine et plus épanouissante avec FitnessXperience, où chaque instant compte dans votre propre épopée vers la santé et le bonheur ! 🍏 ")

# Call the personalized function to display the customized home page
home_page()
