<template>
  <p class="card-footer-item">
    <span>
      <button :class="classes" @click="subscribe">Subscribe </button>
    </span>
  </p>
</template>
<script>
  export default {
    props: ['active'],
    data() {
      return {
        status: this.active
      }
    },
    computed: {
      classes() {
        return [ 'button',  this.status? 'is-info' : ''];
      }
    },
    methods: {
      subscribe() {
        let requestType = this.status ? 'delete' : 'post';
        axios[requestType](location.pathname + '/subscriptions');
        this.status = ! this.status;
      }
    }
  }
</script>