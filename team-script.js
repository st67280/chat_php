function loadTeam() {
    fetch('team.json')
        .then(response => response.json())
        .then(data => {
            const teamContainer = document.getElementById('team-container');
            data.members.forEach(member => {
                const memberDiv = document.createElement('div');
                memberDiv.classList.add('team-member');
                memberDiv.innerHTML = `
                    <img src="${member.photoUrl}" alt="${member.name}">
                    <p>${member.name}</p>
                `;
                teamContainer.appendChild(memberDiv);
            });
        });
}

document.addEventListener('DOMContentLoaded', loadTeam);

document.getElementById('back-button').addEventListener('click', function() {
    window.location.href = 'index.html';
});
