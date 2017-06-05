<template lang="html">
  <div class="privateMessage privatemessage-inbox">
    <section class="header">
      <h3>Welcome to ChittyChat private message section<small>Just chitty chats.</small></h3>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-sm-3">
          <sidebar></sidebar>
        </div>
        <div class="col-sm-7">
          <h1>Welcome</h1>
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
