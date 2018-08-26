<div class="d-flex justify-content-center h4">
    <form id="search">
        <div class="form-group">
            <label for="customer" class="text-muted">Введите id клиента или название клиента</label>
            <input type="text" id="customer" name="customer" class="form-control">
        </div>
        <div class="text-muted">Статус договора</div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="work" value="work">work
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="connecting" value="connecting">connecting
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="disconnected" value="disconnected">disconnected
            </label>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-lg btn-primary" id="send">Отправить</button>
            <button type="reset" class="btn btn-lg btn-danger" id="reset">Сбросить</button>
        </div>
    </form>
</div>
<script src="/js/print/printThis.js"></script>
<script src="/js/search.js"></script>