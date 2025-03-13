document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');
    const deleteDialog = document.getElementById('delete-dialog');
    const confirmDeleteButton = document.getElementById('confirm-delete');
    const cancelDeleteButton = document.getElementById('cancel-delete');
    let storyIdToDelete = null;

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            storyIdToDelete = this.getAttribute('data-story-id');
            deleteDialog.showModal();
        });
    });

    confirmDeleteButton.addEventListener('click', function () {
        if (storyIdToDelete) {
            window.location.href = `index.php?ctrl=mesHistoires&action=delete&id=${storyIdToDelete}`;
        }
    });

    cancelDeleteButton.addEventListener('click', function () {
        deleteDialog.close();
    });
});