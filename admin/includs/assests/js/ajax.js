function showuser() {
    console.log("s");
    const dynamicContent = document.getElementById('dynamic-content');

    if (dynamicContent.style.display === 'none' || dynamicContent.innerHTML.trim() === '') {
        fetch('userindex.php')
            .then(response => response.text())
            .then(data => {
                dynamicContent.innerHTML = data;
                dynamicContent.style.display = 'block';
            })
            .catch(error => {
                dynamicContent.innerHTML = '<p>Error loading the form. Please try again.</p>';
                dynamicContent.style.display = 'block';
                console.error(error);
            });
    } else {
        dynamicContent.style.display = 'none';
    }
}
function showroles() {
    console.log("s");
    const dynamicContent = document.getElementById('dynamic-content');

    if (dynamicContent.style.display === 'none' || dynamicContent.innerHTML.trim() === '') {
        fetch('tableroles.php')
            .then(response => response.text())
            .then(data => {
                dynamicContent.innerHTML = data;
                dynamicContent.style.display = 'block';
            })
            .catch(error => {
                dynamicContent.innerHTML = '<p>Error loading the form. Please try again.</p>';
                dynamicContent.style.display = 'block';
                console.error(error);
            });
    } else {
        dynamicContent.style.display = 'none';
    }
    
}

function showfiles(){
    console.log("s");
    const dynamicContent = document.getElementById('dynamic-content');

    if (dynamicContent.style.display === 'none' || dynamicContent.innerHTML.trim() === '') {
        fetch('fileindex.php')
            .then(response => response.text())
            .then(data => {
                dynamicContent.innerHTML = data;
                dynamicContent.style.display = 'block';
            })
            .catch(error => {
                dynamicContent.innerHTML = '<p>Error loading the form. Please try again.</p>';
                dynamicContent.style.display = 'block';
                console.error(error);
            });
    } else {
        dynamicContent.style.display = 'none';
    }
    
}