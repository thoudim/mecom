$(function(){
  $(document).on('click','#delete',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
      Swal.fire({
        title: 'Are you sure?',
        text: "Delete This Data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
  });

  // Actived Vendor
  $(document).on('click','#activated',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
      Swal.fire({
        title: 'Are you sure?',
        text: "Activate This Vendor?",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, activate this vendor!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link
          Swal.fire(
            'Activated!',
            'Vendor has been activated.',
            'success'
          )
        }
      })
  });
  // Actived Vendor End

  // Inactived Vendor
  $(document).on('click','#inactivated',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
      Swal.fire({
        title: 'Are you sure?',
        text: "Inactivate This Vendor?",
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, inactivate this vendor!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = link
          Swal.fire(
            'Inactivated!',
            'Vendor has been inactivated.',
            'success'
          )
        }
      })
  });
  // Inactived Vendor End


});