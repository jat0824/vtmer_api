<?php

namespace App\Admin\Controllers;

use App\Usr;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UsrController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Usr::class, function (Grid $grid) {

            $grid->id('ID')->sortable();

            $grid->picture('头像')->image();
            $grid->name('联系人')->editable();
            $grid->email('邮箱')->editable();
            $grid->mobile('手机号')->editable();
            $grid->wechat('微信')->editable();

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Usr::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->text('name', '真实姓名')->rules('required');
            $form->image('picture', '头像');
            $form->mobile('phone', '电话')->option(['mask' => '999 9999 9999']);
            $form->email('email', '邮箱')->rules('required');
            $form->text('wechat', '微信')->rules('required');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }

}
