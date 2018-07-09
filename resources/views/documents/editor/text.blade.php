<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    var quill = new Quill('#editor', {
      theme: 'snow',
      placeholder: 'Compose an epic...',
    });

    var form = document.querySelector('#create-doc');

    form.onsubmit = function() {
        var about = document.querySelector('input[name=description]');
        about.value = $( "#editor .ql-editor" ).html();
    };

    document.querySelector("#editor .ql-editor").innerHTML = 
        document.querySelector('input[name=description]').value;
</script>