
@php
    /** @var \App\Models\BlogCategory $item */
    /** @var \Illuminate\Support\Collection $categoryList */
@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Опубликовано
                @else
                    Черновик
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                <div class="card-subtitle mb-2 text-muted"></div>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="active nav-link" data-toggle="tab" href="#maindata" role="tab">Основные данные</a>
                    </li>
                    <li class="nav-item">
                        <a class="active nav-link" data-toggle="tab" href="#adddata" role="tab">Доп. данные</a>
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
                            <label for="content_raw">Статья</label>
                            <textarea name="content_raw"
                                id="content_raw"
                                class="form-control"
                                rows="20">{{ old('content_raw', $item->content_raw) }}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane active" id="adddata" role="tabpanel">
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select name="category_id"
                                   id="category_id"
                                   class="form-control"
                                   placeholder="Выберите категорию">
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id == $item->category_id) selected @endif>
                                        {{$categoryOption->id_title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug">Идентификатор slug</label>
                            <input name="slug" value="{{ $item->slug }}"
                                   id="slug"
                                   type="text"
                                   class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="excerpt">Выдержка</label>
                            <textarea name="excerpt"
                                      id="excerpt"
                                      class="form-control"
                                      rows="3">{{ old('excerpt', $item->excerpt) }}</textarea>
                        </div>
                        <div class="form-check">
                            <input name="is_published"
                                   type="hidden"
                                   value="0">  <!-- Сделано для того чтобы значение отправлялось даже при неактивном чекбоксе -->

                            <input name="is_published"
                                   type="checkbox"
                                   class="form-check-input"
                                   value="1"
                                   @if($item->is_published)
                                   checked="checked"
                                   @endif
                            >
                            <label class="form-check-label" for="is_published">Опубликовано</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


