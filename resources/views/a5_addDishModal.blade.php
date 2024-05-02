<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="modal-content">
        <div id="cont" class="title">
            <input type="text" id="titleInput" placeholder="Title">
        </div>
        <div id="desc" class="desc">
            <input type="text" id="description" placeholder="Brief description of your recipe">
        </div>
        <div class="inputGroup">
            <label for="timeInput">Time</label>
            <input type="text" id="timeInput" placeholder="How long to make (e.g. 1 hour)">
        </div>
        <div class="inputGroup">
            <label for="yieldInput">Yield</label>
            <input type="text" id="yieldInput" placeholder="Amount it makes (e.g. 2 servings)">
        </div>
        <div id="imageContainer" class="placeholder">
            <label for="uploadInput">
                <i id="uploadedImage" class="fas fa-bowl"></i>
                <span style="color:#f79402">Click to upload a photo you took yourself</span>
            </label>
            <input type="file" id="uploadInput" style="display: none;">
        </div>
        <div id="content" class="posi">
            <label class="mt-3" for="ingredientsInput" style="color:#f79402; font-size:larger">Ingredients</label>
            <!-- Bar with placeholders and buttons -->
            <div class="ingredientBars">
                <div class="ingredientBar">
                    <div class="ingredientGroup">
                        <input type="text" placeholder="First ingredient">
                    </div>
                    <div class="buttons">
                        <button class="addButton">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .modal-content {
        max-width: 500px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    .title,
    .desc,
    .inputGroup {
        margin-bottom: 20px;
    }

    .inputGroup label {
        margin-right: 10px;
    }

    input[type="text"] {
        width: calc(100% - 50px);
        /* Adjust width */
        padding: 10px;
        border: none;
        border-bottom: 1px solid #ccc;
        outline: none;
        font-size: 16px;
    }

    .placeholder {
        text-align: center;
        border: 2px solid #aaa;
        padding: 40px;
        border-radius: 20px;
    }

    .placeholder img {
        max-width: 100%;
    }

    .ingredientBar {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .ingredientGroup {
        flex: 1;
        margin-right: 10px;
    }

    .buttons {
        display: flex;
    }

    .addButton {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: #f79402;
        color: white;
        margin-left: 10px;
    }

    .crossButton,
    .moveButton {
        padding: 10px;
        border: none;
        background: none;
        cursor: pointer;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const addButton = document.querySelector('.addButton');
        const ingredientBars = document.querySelector('.ingredientBars');
        let ingredientCount = 0;

        addButton.addEventListener('click', function () {
            ingredientCount++;

            const newIngredientBar = document.createElement('div');
            newIngredientBar.classList.add('ingredientBar');

            const ingredientGroup = document.createElement('div');
            ingredientGroup.classList.add('ingredientGroup');

            const ingredientInput = document.createElement('input');
            ingredientInput.type = 'text';
            ingredientInput.placeholder = 'Other ingredient';
            ingredientInput.classList.add('ingredientInput');

            const moveButton = document.createElement('button');
            moveButton.classList.add('moveButton');
            moveButton.innerHTML = '<i class="fas fa-arrows-alt-v"></i>'; // Font Awesome move icon

            const crossButton = document.createElement('button');
            crossButton.classList.add('crossButton');
            crossButton.innerHTML = '<i class="fas fa-times"></i>'; // Font Awesome close icon

            const ingredientCountText = document.createElement('span');
            ingredientCountText.classList.add('ingredientCount');
            ingredientCountText.innerText = ingredientCount;

            newIngredientBar.appendChild(ingredientCountText);
            newIngredientBar.appendChild(ingredientGroup);
            newIngredientBar.appendChild(moveButton);
            newIngredientBar.appendChild(crossButton);
            ingredientGroup.appendChild(ingredientInput);
            ingredientBars.appendChild(newIngredientBar);

            // Add event listener for cross button
            crossButton.addEventListener('click', function () {
                ingredientCount--;
                this.parentElement.remove();
                updateIngredientCounters();
            });

            // Add drag-and-drop functionality
            newIngredientBar.draggable = true;
            newIngredientBar.addEventListener('dragstart', dragStart);
            newIngredientBar.addEventListener('dragover', dragOver);
            newIngredientBar.addEventListener('dragenter', dragEnter);
            newIngredientBar.addEventListener('dragleave', dragLeave);
            newIngredientBar.addEventListener('drop', drop);

            updateIngredientCounters();
        });

        function updateIngredientCounters() {
            const counters = document.querySelectorAll('.ingredientCount');
            counters.forEach((counter, index) => {
                counter.innerText = index + 1;
            });
        }

        // Drag and drop functions
        let dragItem = null;

        function dragStart() {
            dragItem = this;
            setTimeout(() => {
                this.style.display = 'none';
            }, 0);
        }

        function dragOver(e) {
            e.preventDefault();
        }

        function dragEnter(e) {
            e.preventDefault();
            this.style.backgroundColor = 'lightgray';
        }

        function dragLeave() {
            this.style.backgroundColor = '';
        }

        function drop() {
            this.style.backgroundColor = '';
            ingredientBars.insertBefore(dragItem, this.nextSibling);
            setTimeout(() => {
                dragItem.style.display = 'flex';
                dragItem = null;
            }, 0);
            updateIngredientCounters();
        }
    });
</script>

</html>