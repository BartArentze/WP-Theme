window.onload = function(){
    const actualBtn = document.getElementById('actual-btn');

    const fileChosen = document.getElementById('file-chosen');
    
    actualBtn.onchange = function(){
        fileChosen.textContent = this.files[0].name
    }
}