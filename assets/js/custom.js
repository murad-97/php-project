var categories = document.getElementsByClassName('categories');

for (var j = 0; j < categories.length; j++) {
    categories[j].addEventListener('mouseover', function() {
        // this.style.transform = 'scale(1.2)';
        this.style.color = 'green';
        this.style.fontSize = '2em';
    });

    categories[j].addEventListener('mouseout', function() {
        // this.style.transform = 'scale(1)';
        this.style.color = '';
        this.style.fontSize = ''; 
    });
}


