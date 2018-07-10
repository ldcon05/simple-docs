<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script>

    var data = document.getElementById("body").value;
    var form = document.querySelector('#create-doc');
    var simplemde = new SimpleMDE(
        { 
            element: document.getElementById("body"),
            initialValue: "# Hello world!",
            hideIcons: ["guide", "fullscreen", "side-by-side"]
        }
    );

    // Data to edit
    if (data)
        simplemde.value(data)

    // Send Data
    form.onsubmit = function() {
        var about = document.querySelector('input[name=body]');
        about.value = simplemde.value();
    };
    
</script>