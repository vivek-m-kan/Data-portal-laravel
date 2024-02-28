<div>
    Counter component in Alpine:

    <div x-data="counter">
        <h1 x-text="count"></h1>
        <button x-on:click="increment">+</button>
        <button x-on:click="decrement">-</button>
    </div>
</div>

@script
<script>
    Alpine.data('counter', () => {
        return {
            count: 0,
            increment() {
                this.count++
            },
            decrement() {
                this.count && this.count--
            },
        }
    })
</script>
@endscript
