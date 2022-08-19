if(document.getElementById('avatar')){
    let uploadField = document.getElementById("avatar");
    let blah = document.getElementById("ava")
    uploadField.onchange = function() {
        if(this.files[0].size > 2097152){
            alert("File is too big!");
            this.value = "";
        }
        else{
            const file = this.files[0]
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    };
}
