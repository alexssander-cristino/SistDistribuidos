export const handler = async (event) => {

    console.log("=== PROCESSAMENTO SQS ===");

    for (const record of event.Records) {
        const body = JSON.parse(record.body);

        console.log("Seat:", body.seat);
        console.log("Cliente:", body.cliente);
        console.log("Status: processado pela Lambda");
    }

    return {
        statusCode: 200,
        body: "OK"
    };
};