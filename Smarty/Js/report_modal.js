document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('[data-modal-target]').forEach(openBtn => {
    const targetId = openBtn.getAttribute('data-modal-target');
    const modal = document.getElementById(targetId);
    const orderId = openBtn.getAttribute('data-order-id');
    console.log(orderId);
            
    // Imposta l'ID dell'ordine nel form
    if (orderId) {
        document.getElementById('ordine_id').value = orderId;
        document.getElementById('modal-order-id').textContent = orderId;
    }

    if (!modal) return;

    openBtn.addEventListener('click', () => {
      modal.style.display = 'block';
    });

    const closeBtn = modal.querySelector('.close-button');
    if (closeBtn) {
      closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
      });
    }

    window.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  });
});




