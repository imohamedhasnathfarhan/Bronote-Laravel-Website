@extends('layout')

@section('content')

<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span class="h4 mb-0">Create Notes Here!</span>
        <div class="btn-group">
            <button class="btn btn-sm btn-outline-light" title="Add Note" data-toggle="modal" data-target="#addNoteModal">
                Add Note
            </button>
        </div>
    </div>
    <div class="card-body text-center">
        <h2>Welcome !!!!!!</h2>
        <div class="box">
            <!-- Display entered data here -->
        </div>
    </div>
</div>

<!-- Add Note Modal -->
<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNoteModalLabel">Add Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="noteForm" method="post" action="{{ route('notes.store') }}">
                    @csrf <!-- Include CSRF token -->
                    <div class="form-group">
                        <label for="noteTitle">Title:</label>
                        <input type="text" class="form-control" id="noteTitle" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="noteContent">Contents:</label>
                        <textarea class="form-control" id="noteContent" rows="4" placeholder="Enter content"></textarea>
                    </div>
                    <!-- Add any other form fields as needed -->

                    <!-- You can customize the button or add additional buttons as needed -->
                    <button type="submit" class="btn btn-primary">Save Note</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add this at the bottom of your HTML file, after the jQuery script -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Array to store notes
        var notes = [];

        // Variable to store the index of the note being edited
        var editingIndex = -1;

        // Handle form submission
        $("#noteForm").submit(function(event) {
            event.preventDefault();

            // Log to check if form submission is triggered
            console.log('Form submitted');

            // Get entered data
            var title = $("#noteTitle").val();
            var content = $("#noteContent").val();

            // Create a new note object
            var note = {
                title: title,
                content: content
            };

            // Check if we are editing an existing note
            if (editingIndex !== -1) {
                // Replace the note at the editingIndex
                notes[editingIndex] = note;

                // Reset editingIndex
                editingIndex = -1;
            } else {
                // Add the note to the array
                notes.push(note);
            }

            // Display entered data in the box div
            updateNotesDisplay();

            // Close the modal
            $("#addNoteModal").modal("hide");

            // Reset the form
            $("#noteForm")[0].reset();

            // Reset editingIndex to -1
            editingIndex = -1;
        });

        // Handle edit button click
        $(document).on("click", ".editNote", function() {
            var index = $(this).data("index");
            var note = notes[index];

            // Fill the form with the note data
            $("#noteTitle").val(note.title);
            $("#noteContent").val(note.content);

            // Set the editingIndex
            editingIndex = index;

            // Open the modal
            $("#addNoteModal").modal("show");
        });

        // Handle delete button click
        $(document).on("click", ".deleteNote", function() {
            var index = $(this).data("index");

            // Remove the note from the array
            notes.splice(index, 1);

            // Display updated notes
            updateNotesDisplay();
        });

        // Function to update the notes display
        function updateNotesDisplay() {
            // Clear the box div
            $(".box").empty();

            // Display each note in the box div
            notes.forEach(function(note, index) {
                var noteHtml = `
                    <div class="note">
                        <h3>Title: ${note.title}</h3>
                        <p>Content: ${note.content}</p>
                        <button class="btn btn-info editNote" data-index="${index}">Edit</button>
                        <button class="btn btn-danger deleteNote" data-index="${index}">Delete</button>
                    </div>
                `;
                $(".box").append(noteHtml);
            });
        }
    });
</script>

@stop
