$('#currencyForm').submit(function(event) {
    event.preventDefault();
    
    var from = $('#from').val();
    var to = $('#to').val();
    var amount = $('#amount').val();
    
    fetch(`/currency?from=${from}&to=${to}&amount=${amount}`)
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