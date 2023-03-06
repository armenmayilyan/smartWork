function getId(id) {
    console.log(id)
    document.getElementById('delhidden').value = id
    document.getElementById('hidden').value = id
}

let category = document.getElementById('floatingSelectGrid')
$('#floatingSelectGrid').on('change', function () {
    let hidden = document.getElementById('category').value = category.value
    console.log(hidden)
    // $.ajax({
    //     type: 'get',
    //     url: '../ajax.php',
    //     data: {
    //         id: category.value,
    //         action: 'checkTheAvailabilityOrder'
    //     },
    //     success: function (res) {
    //         window.location.href = "http://localhost:8001/view/tests.php"
    //        // let response = JSON.parse(res)
    //        //  console.log(response)
    //     }
    // });
})