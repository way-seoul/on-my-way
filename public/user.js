
console.log('HI User.js');

// Reset user password
let reset_buttons = document.querySelectorAll('button.reset-password');

reset_buttons.forEach(reset_button => {

    let id = reset_button.getAttribute('data-id');

    reset_button.addEventListener('click', function(){
        let formData = new FormData();
        formData.append('id', id);
        formData.append('reset', 'reset');

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php?action=admin');
        xhr.send(formData);

        xhr.addEventListener('readystatechange', function(){
            if(xhr.readyState == XMLHttpRequest.DONE){
                alert("Password reset successful!");
            }
        })
    })
})


//User Delete Function using AJAX
let buttons = document.querySelectorAll('button.delete-user');

buttons.forEach(button => {

    let id = button.getAttribute('data-id');

    button.addEventListener('click', function(e){
        e.preventDefault();

        let formData = new FormData();
        formData.append('id', id);
        formData.append('delete', 'delete');

        let xhr = new XMLHttpRequest();
        xhr.open('POST', '');
        xhr.send(formData);


        // when we're done with the request
        xhr.addEventListener('readystatechange', function(){
            if(xhr.readyState == XMLHttpRequest.DONE){

                // get a reference to the row for the place
                let row = button.closest("tr");

                //delete row
                row.remove();
            }
        });


    });

});


