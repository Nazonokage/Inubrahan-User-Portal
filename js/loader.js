document.addEventListener('DOMContentLoaded', function () {
    const loading = document.getElementById('loading');
    const container = document.querySelector('.container');
    const form = document.querySelector('form');

    // Hide loader initially
    loading.style.display = 'none';
    container.style.display = 'block';

    // Add submit event listener to the form
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent immediate form submission

        // Show the loader and hide the container
        loading.style.display = 'flex';
        container.style.display = 'none';

        // Simulate loading time and show success message
        setTimeout(() => {
            // Show success alert
            // alert('Success!');

            // Submit the form after alert
            form.submit();
        }, 3000); // 3-second delay
    });
});
