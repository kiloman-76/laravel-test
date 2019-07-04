
    @php
        /** @var \App\Models\BlogCategory $item */
    @endphp
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"></div>
                    <ul role="tablist" class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#maindata" data-toggle="tab" role="tab" class="nav-link active">Основные данные</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane active" id="maindata" role="tabpanel">
                            <div class="form-group">
                                <label for="title">Заголовок</label>
                                <input name="title" value="{{ $item->title }}"
                                        id="title"
                                        type="text"
                                        class="form-control"
                                        minlength="3"
                                        required>
                            </div>

                            <div class="form-group">
                                <label for="slug">Идентификатор</label>
                                <input name="slug" value="{{ $item->slug }}"
                                       id="slug"
                                       type="text"
                                       class="form-control"
                            </div>

                            <div class="form-group">
                                <label for="parent_id">Родитель</label>
                                <select name="parent_id"
                                    id="parent_id"
                                    type="text"
                                    class="form-control"
                                    placeholder="Выберите категорию"
                                    required>
                                    @foreach($categoryList as $categoryOption)

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

