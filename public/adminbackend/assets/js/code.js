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

// Confirm Order
$(function(){
  $(document).on('click','#confirm',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: 'Are you sure to Confirm?',
      text: "Once Confirm, You will not be able to pending again?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Confirm!'
    }).then((result) => {
      if(result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Confirm!',
          'Confirm Change',
          'success'
        )
      }
    })
  });
});
// End Confirm Order

// Processing Order
$(function(){
  $(document).on('click','#processing',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: 'Are you sure to Processing?',
      text: "Once Processing, You will not be able to pending again?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Processing!'
    }).then((result) => {
      if(result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Processing!',
          'Processing Change',
          'success'
        )
      }
    })
  });
});
// End Processing Order

// Delivered Order
$(function(){
  $(document).on('click','#delivered',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: 'Are you sure to Delivered?',
      text: "Once Delivered, You will not be able to pending again?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Delivered!'
    }).then((result) => {
      if(result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Delivered!',
          'Delivered Change',
          'success'
        )
      }
    })
  });
});
// End Delivered Order

// Return Approved Order
$(function(){
  $(document).on('click','#approved',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: 'Are you sure to Approved?',
      text: "Return Order Approved",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Approved!'
    }).then((result) => {
      if(result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Approved!',
          'Approved Change',
          'success'
        )
      }
    })
  });
});
// End Return Approved Order