<?php


namespace Base;


class View
{
    protected $tpl_path;

    /**
     * @return mixed
     */
    public function getTplPath()
    {
        return $this;
    }


    /**
     * @param mixed $tpl_path
     */
    public function setTplPath($tpl_path): void
    {
        $this->tpl_path = $tpl_path;
    }

    public function render($tpl_name,$title)
    {
        extract($title);

        include $this->tpl_path . '/'. $tpl_name;
    }
 public function renderTwo($tpl_name,$title)
    {
        extract($title);

        include $this->tpl_path . '/'. $tpl_name;
    }


}