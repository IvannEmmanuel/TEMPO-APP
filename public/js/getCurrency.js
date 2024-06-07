$('#currencyForm').submit(function(event) {
    event.preventDefault();
    
    var from = $('#from').val();
    var to = $('#to').val();
    var amount = $('#amount').val();
    
    // Construct the headers
    var headers = new Headers();
    headers.append('Authorization', 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiNjM3ZjViNDExYTNkNmUyNDA2MmRjMDVmOGVhZDk1ODIzMTRkZGViMzdhYmUxN2NiMDFmYzJjMDdkZGViOTNiNzQyNGIyZDEwMWE4OGE5MWEiLCJpYXQiOjE3MTc0NjU3MjQuMzQ1NzQzLCJuYmYiOjE3MTc0NjU3MjQuMzQ1NzQ4LCJleHAiOjE3NDkwMDE3MjMuOTMxMjc2LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.hy1AgKGEM9x4_xwBhn-MAvFXWds4jlfOXY5xfRyG7mDL8UfPy1w382We2Yk9zBJay2Wsfni8zmw5bUJOl4LkZja7AmRD-20RxdY-a4HNPFrJEIcWzgaPFmLQOzKzhXivFi_5N6GFKGYuwWGTSjnDebib0LEj4SP7jVWJ5Y7kZmwSiQuWXandCFRE7SEUJRLjp9DOfyAJ5MkKD1FEQ-8TYXGVSFneyiyMx9trjZvNkcXRSW_DQBOUrqFeCq872JgICEecAJMs9SlyKuss5iq6gVCNC_QnwXWrY7L9YXVtx_lrQUKPgakRep7qQLykC-8Py3uW4kR4dhZ0VEU4a1PaB42nGkaQFkMDd-zUE321AEm-X2wZwzYM6TQPsIJnedUtEce2PaoRqT8iO7vKEtJLDWLu9qZUYV41J0kvcnHX_DUK1RWE80hAgTAmT57tOCryn2ZA9knJ4UQmC_coLvoslqOz8pYtcjoctRgV5ucI5hoE9yRk7EY2uQ-MHXZ1BngYB58SmGYQil2KTpIlKulkYl-BazGTjGJGgZu5_OkivXwlTXUEgfZkGTyoMn0FFjUFbyKGQdfTTL1Vd6bhbnavveyw3qcE5Ao_4h63qZ9Poofol2OZThYm2MREp01V2MR7Es8lMFh612T2HAOjUWRzqdSeksDdeuLV50MAHjqnw50');

    // Construct the request
    var request = new Request(`/currency?from=${from}&to=${to}&amount=${amount}`, {
        method: 'GET',
        headers: headers
    });

    // Fetch the data
    fetch(request)
    .then(response => response.json())
    .then(data => {
        if(data.error) {
            $('#result').text(data.error);
        } else {
            var resultMessage = `Converted -> ${data.request.from}: ${data.request.amount}, To ${data.request.to}: ${data.result}\n`;
            var formattedMessage = `From: ${data.meta.formated.from}, To: ${data.meta.formated.to}`;
            $('#result').html(resultMessage + '<br>' + formattedMessage);
        }
    })
    .catch(error => console.error('Error:', error));
});
