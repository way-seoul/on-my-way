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