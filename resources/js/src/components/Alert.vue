<template>
  <div class="rounded-md bg-red-50 p-4">
    <div class="flex">
      <div class="ml-3">
        <div class="mt-2 text-sm text-red-700">
            {{title}}
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default{
    name:'Alert',

    props:['title']
}
</script>