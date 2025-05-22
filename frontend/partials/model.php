<?php
/**
 * Universal Bootstrap Modal
 * 
 * @param string $modalId - Unique ID for modal instance
 * @param string $modalTitle - Modal title
 * @param string $modalBody - HTML content inside modal body
 * @param string $submitButtonText - Text on the submit button
 */
?>

<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?= $modalId ?>Label"><?= $modalTitle ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <?= $modalBody ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="submit_<?= $modalId ?>" class="btn btn-primary"><?= $submitButtonText ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
