<template>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-1 hidden-xs">
                    <img :src="require('../bus.svg')" alt="" class="img-thumbnail">
                </div>
            </div>
        </div>
    </div>
</template>

<<script>
export default {
    name: "TripCard"
}
</script>