document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById('roleModal');
    const closeModal = document.querySelector('.close-modal');
    const roleForm = document.getElementById('roleForm');

    document.querySelectorAll('.check-info').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const roleId = this.dataset.roleId;
            const roleName = this.dataset.roleName;
            
            document.getElementById('modalRoleId').value = roleId;
            document.getElementById('modalStatus').value = roleName;

            modal.classList.remove('hidden');
        });
    });

    closeModal.addEventListener('click', function() {
        modal.classList.add('hidden');
    });

    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
});
