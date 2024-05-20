{{-- resources/views/components/notification.blade.php --}}

<style>
    .notification {
        position: fixed;
        top: 10%;
        left: 50%;
        width: 30%;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.5);
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
        z-index: 9999;
    }

    .notification.show {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }

    .notification.success {
        background-color: #d4edda;
        color: #155724;
    }

    .notification.error {
        background-color: #f8d7da;
        color: #721c24;
    }

    .notification .close {
        position: absolute;
        top: 5px;
        right: 10px;
        background: transparent;
        border: none;
        font-size: 16px;
        cursor: pointer;
        color: inherit;
    }
</style>

@if(session('success'))
    <div id="notification-success" class="notification success">
        {{ session('success') }}
        <button class="close" onclick="closeNotification('notification-success')">&times;</button>
    </div>
@endif

@if(session('error'))
    <div id="notification-error" class="notification error">
        {{ session('error') }}
        <button class="close" onclick="closeNotification('notification-error')">&times;</button>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (document.getElementById('notification-success')) {
            setTimeout(function () {
                document.getElementById('notification-success').classList.add('show');
            }, 100);
            setTimeout(function () {
                closeNotification('notification-success');
            }, 5000);
        }

        if (document.getElementById('notification-error')) {
            setTimeout(function () {
                document.getElementById('notification-error').classList.add('show');
            }, 100);
            setTimeout(function () {
                closeNotification('notification-error');
            }, 5000);
        }
    });

    function closeNotification(id) {
        var notification = document.getElementById(id);
        if (notification) {
            notification.classList.remove('show');
            setTimeout(function () {
                notification.remove();
            }, 500);
        }
    }
</script>
