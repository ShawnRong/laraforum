<template>
  <span class="icon is-large">
    <button type="submit" :class="classes" @click="toggle">
      <i class="ion-md-heart"></i>
      <span v-text="favoritesCount"></span>
    </button>
  </span>
</template>

<script>
  export default {
    props: ['reply'],
    data() {
      return {
        favoritesCount: this.reply.favoritesCount,
        isFavorited: this.reply.isFavorited
      }
    },
    computed: {
      classes() {
        return [this.isFavorited ? 'is-red': '']
      },
      endpoint() {
        return '/replies/' + this.reply.id + '/favorites';
      }
    },
    methods: {
      toggle() {
        return this.isFavorited ? this.destroy() : this.create();
      },
      create() {
        axios.post(this.endpoint);
        this.isFavorited = true;
        this.favoritesCount++;
      },
      destroy() {
        axios.delete(this.endpoint);
        this.isFavorited = false;
        this.favoritesCount--;
      }
    }
  }
</script>