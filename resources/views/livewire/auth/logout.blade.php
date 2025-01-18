<div>
    <form id="logoutForm" class="space-y-4 w-full md:space-y-6" wire:submit.prevent="logout">
        <button id="logoutBtn" type="submit">Logout</button>
    </form>
</div>

<script>
    var logoutBtn = document.getElementById("logoutBtn");
    var logoutForm = document.getElementById("logoutForm");

    logoutBtn.addEventListener('click', function(event) {
        event.preventDefault(); 
        // Show confirmation dialog
        if (confirm('Are you sure you want to logout?')) {
            // If the user confirms, submit the form progr ammatically
            logoutForm.dispatchEvent(new Event('submit', {
                'bubbles': true
            }));
        } else {
            return;
        }
    });
</script>
