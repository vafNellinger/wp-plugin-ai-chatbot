<?php

namespace WP\Plugin\AIChatbot\Templates\AdminPages;

use VAF\WP\Framework\Template\Attribute\IsTemplate;
use VAF\WP\Framework\Template\Template;
use WP\Plugin\AIChatbot\ModelEngine\ModelEngine;
use WP\Plugin\AIChatbot\Settings\ActiveEngine;
use WP\Plugin\AIChatbot\Settings\Connection;
use WP\Plugin\AIChatbot\VectorDB\VectorDB;


#[IsTemplate(templateFile: '@wp-plugin-ai-chatbot/adminpages/vectorDB')]
#[UseScript(src: 'js/modelEngine.min.js', deps: ['jquery'])]
//#[UseAdminAjax('get-top-ten-queries')]
class VectorDBPageTemplate extends Template
{
    private ActiveEngine $activeEngine;
    private Connection $connection;
    private array $engines = [];

    public function addEngine(VectorDB $engine): self
    {
        $this->engines[$engine->getId()] = [
            'description' => $engine->getDescription(),
            'connectionSettings' => $engine->getConnectionSettings()
        ];
        return $this;
    }

    public function setConnection(Connection $connection): self
    {
        $this->connection = $connection;
        return $this;
    }

    public function setActiveEngine(ActiveEngine $engine): self
    {
        $this->activeEngine = $engine;
        return $this;
    }

    protected function getContextData(): array
    {
        return [
            'engines' => $this->engines,
            'activeEngine' => $this->activeEngine,
            'connection' => $this->connection
        ];
    }
}
