<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script>

    var data = document.getElementById("description").value;
    var simplemde = new SimpleMDE(
        { 
            element: document.getElementById("description"),
            initialValue: "# Hello world!",
            hideIcons: ["guide", "fullscreen", "side-by-side"]
        }
    );

    if (data)
        simplemde.value(data)

    var form = document.querySelector('#create-doc');
    form.onsubmit = function() {
        var about = document.querySelector('input[name=description]');
        about.value = simplemde.value();
    };
    
</script>