Dropzone.autoDiscover = false;

$(document).ready(function () {
  $("#image").rcrop({
    minSize: [200, 200],
    preserveAspectRatio: true,

    preview: {
      display: true,
      size: [100, 100],
    },
  });
});
