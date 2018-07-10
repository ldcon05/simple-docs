<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#editor', {
      theme: 'snow',
      placeholder: 'Compose an epic...',
    });

    //Send Data
    var form = document.querySelector('#create-doc');

    form.onsubmit = function() {
        var about = document.querySelector('input[name=body]');
        about.value = $( "#editor .ql-editor" ).html();
    };

    // Data to Edit
    document.querySelector("#editor .ql-editor").innerHTML = 
        document.querySelector('input[name=body]').value;
</script>