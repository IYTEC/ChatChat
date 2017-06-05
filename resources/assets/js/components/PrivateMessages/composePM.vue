<template lang="html">
  <div class="privateMessage privatemessage-inbox">
    <section class="header">
      <h3>Compose Private Message <small>compose a private message.</small></h3>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-3">
          <sidebar></sidebar>
        </div>
        <div class="col-sm-7">
          <h3>Compose a private message</h3>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
    import sidebar from './Sidebar'
    export default {
      components: {
        sidebar
      }
    }
</script>
