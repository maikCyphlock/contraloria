<?php
declare(strict_types=1);
?>
<script>
function toggleFaq(button) {
  const answer = button.nextElementSibling;
  button.classList.toggle('open');
  answer.classList.toggle('show');
}
</script>
