<template>
  <footer>
    <div class="footer-container">
      <div class="social-link">
        facebook
      </div>
      <div class="copy-right">
        .Copyright © Davod Narouey All Rights Reserved
      </div>
    </div>
  </footer>
</template>

<script>
export default {
}
</script>

<style>
footer {
  background-color: #f9f9fb;
  margin-top: 10rem;
}


.footer-container {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap-reverse;
}
.copy-right {
  flex-grow: 1;
  padding: 0.5rem;
  text-align: left;
}

.social-link {
  flex-grow: 1;
  padding: 0.5rem;
  text-align: center;
}
</style>
