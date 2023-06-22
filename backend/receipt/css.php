<style>
[name=order-list-table]>thead th,
[name=order-list-table]>tbody td {
    white-space: nowrap;
}

.table-bordered thead td,
.table-bordered thead th {
    border-bottom-width: 2px;
    white-space: nowrap;
}

#order-list-table .input-group {
    flex-wrap: nowrap;
}

#order-list-table input {
    min-width: 70px;
}

.m-0 {
    font-size: clamp(20px, 2.5vw, 25px);
    font-weight: bold;
}

.content-group {
    position: relative;
    width: 100%;
    border: 2px solid #dedede;
    padding: 14px 8px;
    margin-bottom: 24px;
}

.content-group:before {
    content: attr(title);
    position: absolute;
    top: -15px;
    left: 24px;
    background-color: white;
    padding: 3px 4px;
    font-size: 0.9rem;
    font-weight: 500;
    letter-spacing: 0.7px;
}


</style>