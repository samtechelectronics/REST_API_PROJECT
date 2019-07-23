<template>
     <div >
        <nav_component></nav_component>
        <!-- <aside_component></aside_component> -->
        <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
     
     <sidebar></sidebar>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

        </div>
    </div>
</div>
</div>
</template>

<script>
    export default {
        data(){
            return {

            }
        },
        mounted() {
            console.log('login out.');
             // localStorage.removeItem('user-token')
        }
    }
</script>
